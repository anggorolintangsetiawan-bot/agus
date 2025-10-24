import React, { useState, useEffect } from 'react';

const RedoBrandGuidelines = () => {
  const [activePage, setActivePage] = useState('brand-guidelines');
  const [contents, setContents] = useState([]);
  const [loading, setLoading] = useState(true);
  const [isEditing, setIsEditing] = useState(false);
  const [aboutContent, setAboutContent] = useState({
    title: 'Tentang Redo',
    description: 'Platform inovatif untuk koreksi finansial dan optimasi neraca keuangan',
    mission: 'Misi kami adalah memberikan solusi terbaik untuk mengelola dan mengoptimalkan data keuangan dengan presisi dan kejelasan',
    vision: 'Menjadi platform terdepan dalam transformasi digital keuangan'
  });

  useEffect(() => {
    loadContents();
  }, []);

  const loadContents = async () => {
    try {
      const stored = await window.storage.get('redo-contents');
      if (stored && stored.value) {
        setContents(JSON.parse(stored.value));
      } else {
        // Data default
        const defaultContents = [
          { id: 1, title: 'Brand Strategy', order: 1, description: 'Core brand positioning and values' },
          { id: 2, title: 'Personality', order: 2, description: 'Brand voice and character' },
          { id: 3, title: 'Logo', order: 3, description: 'Logo usage and specifications' },
          { id: 4, title: 'Color', order: 4, description: 'Color palette and guidelines' },
          { id: 5, title: 'Typography', order: 5, description: 'Font families and hierarchy' }
        ];
        setContents(defaultContents);
        await window.storage.set('redo-contents', JSON.stringify(defaultContents));
      }
    } catch (error) {
      console.log('Storage not available, using defaults');
      setContents([
        { id: 1, title: 'Brand Strategy', order: 1 },
        { id: 2, title: 'Personality', order: 2 },
        { id: 3, title: 'Logo', order: 3 },
        { id: 4, title: 'Color', order: 4 },
        { id: 5, title: 'Typography', order: 5 }
      ]);
    } finally {
      setLoading(false);
    }
  };

  const saveContents = async (newContents) => {
    try {
      await window.storage.set('redo-contents', JSON.stringify(newContents));
      setContents(newContents);
    } catch (error) {
      console.error('Error saving:', error);
    }
  };

  const addContent = async () => {
    const newItem = {
      id: Date.now(),
      title: 'New Section',
      order: contents.length + 1,
      description: 'Add description here'
    };
    await saveContents([...contents, newItem]);
  };

  const updateContent = async (id, field, value) => {
    const updated = contents.map(item => 
      item.id === id ? { ...item, [field]: value } : item
    );
    await saveContents(updated);
  };

  const deleteContent = async (id) => {
    const filtered = contents.filter(item => item.id !== id);
    await saveContents(filtered);
  };

  const menuItems = [
    { id: 'home', label: 'Home', badge: '01' },
    { id: 'tentang', label: 'Tentang', badge: '02' },
    { id: 'data-log', label: 'Data Log', badge: '03' },
    { id: 'tabel-data', label: 'Tabel Data', badge: '04' },
    { id: 'pengaturan', label: 'Pengaturan', badge: '05' }
  ];

  return (
    <div className="flex h-screen bg-gray-50">
      {/* Sidebar */}
      <div className="w-48 bg-white border-r border-gray-200 flex flex-col">
        <div className="p-6 border-b border-gray-200">
          <div className="flex items-center gap-2">
            <svg className="w-6 h-6" viewBox="0 0 24 24" fill="none">
              <path d="M13 3L3 14h8v7l10-11h-8V3z" fill="currentColor"/>
            </svg>
            <span className="font-semibold text-lg">Redo</span>
          </div>
        </div>
        
        <nav className="flex-1 p-4">
          {menuItems.map(item => (
            <button
              key={item.id}
              onClick={() => setActivePage(item.id)}
              className={`w-full text-left px-3 py-2 rounded mb-1 text-sm flex items-center gap-2 ${
                activePage === item.id ? 'bg-gray-100' : 'hover:bg-gray-50'
              }`}
            >
              <span>{item.label}</span>
              <span className="text-xs text-gray-400">{item.badge}</span>
            </button>
          ))}
        </nav>

        <div className="p-4 border-t border-gray-200 space-y-1">
          <button className="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 rounded">
            Download Kit
          </button>
          <button className="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 rounded">
            Contact Us
          </button>
        </div>
      </div>

      {/* Main Content */}
      <div className="flex-1 overflow-auto">
        {/* Hero Section */}
        <div className="relative h-80 bg-gradient-to-br from-blue-400 via-orange-300 to-orange-400 flex items-center justify-center">
          <div className="absolute inset-0 bg-gradient-to-br from-teal-500/20 to-transparent"></div>
          <div className="relative flex items-center gap-4 text-white">
            <svg className="w-16 h-16" viewBox="0 0 24 24" fill="none">
              <path d="M13 3L3 14h8v7l10-11h-8V3z" fill="currentColor"/>
            </svg>
            <h1 className="text-7xl font-bold">Redo</h1>
          </div>
        </div>

        {/* Content Section */}
        <div className="max-w-6xl mx-auto p-12">
          <div className="grid grid-cols-2 gap-16">
            {/* Left Column */}
            <div>
              <h2 className="text-5xl font-bold mb-4 leading-tight">
                Brand<br/>Guidelines
              </h2>
            </div>

            {/* Right Column */}
            <div className="space-y-6 text-gray-700">
              <p>
                This guide defines the visual language, design style, and principles 
                needed to shape a clear and consistent brand experience, no matter 
                the team or area of expertise.
              </p>
              <p>
                At its core, Redo is about precision and clarity—just like our mission 
                to correct financial errors and optimize balance sheets. This guide lays 
                out the essential design standards that bring our brand to life, from our 
                color system and typography to accessibility benchmarks and documentation.
              </p>
              <p>
                Whether you're designing for digital platforms or printed materials, these 
                guidelines ensure every touchpoint reflects the trust and efficiency at the 
                heart of Redo.
              </p>
            </div>
          </div>

          {/* Contents Section */}
          <div className="grid grid-cols-2 gap-16 mt-20">
            <div className="flex items-center justify-between">
              <h3 className="text-3xl font-bold">Contents</h3>
              <button
                onClick={() => setIsEditing(!isEditing)}
                className="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm"
              >
                {isEditing ? 'Done' : 'Edit'}
              </button>
            </div>
            <div>
              {loading ? (
                <div className="text-gray-500">Loading contents...</div>
              ) : (
                <div className="space-y-3">
                  {contents.map((item, index) => (
                    <div key={item.id} className="flex items-center gap-3">
                      {isEditing ? (
                        <>
                          <span className="text-gray-400">0{index + 1}</span>
                          <input
                            type="text"
                            value={item.title}
                            onChange={(e) => updateContent(item.id, 'title', e.target.value)}
                            className="flex-1 px-2 py-1 border rounded text-lg"
                          />
                          <button
                            onClick={() => deleteContent(item.id)}
                            className="text-red-500 hover:text-red-700"
                          >
                            ✕
                          </button>
                        </>
                      ) : (
                        <>
                          <span className="text-gray-400 text-xl">0{index + 1}</span>
                          <span className="font-medium text-xl">{item.title}</span>
                        </>
                      )}
                    </div>
                  ))}
                  {isEditing && (
                    <button
                      onClick={addContent}
                      className="text-blue-500 hover:text-blue-700 text-sm mt-4"
                    >
                      + Add Section
                    </button>
                  )}
                </div>
              )}
            </div>
          </div>

          {/* Info Box */}
          <div className="mt-16 p-6 bg-green-50 rounded-lg border border-green-200">
            <h4 className="font-bold text-lg mb-3">✨ Fitur</h4>
            <ul className="space-y-2 text-sm text-gray-700">
              <li>✅ Data tersimpan otomatis di browser (persistent storage)</li>
              <li>✅ Klik tombol "Edit" untuk mengedit konten</li>
              <li>✅ Tambah/hapus section sesuai kebutuhan</li>
              <li>✅ Sidebar navigasi yang responsif</li>
              <li>✅ Design sesuai brand guidelines asli</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  );
};

export default RedoBrandGuidelines;