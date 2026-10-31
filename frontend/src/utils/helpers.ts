// ✅ 1. Format Date
// Example: Converts "2026-10-30" to "Oct 30, 2026"
export const formatDate = (dateString: string): string => {
  if (!dateString) return 'N/A';
  const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'short', day: 'numeric' };
  return new Date(dateString).toLocaleDateString('en-US', options);
};

// ✅ 2. Format Currency
// Example: Converts 5000 to "5,000.00 ETB"
export const formatCurrency = (amount: number): string => {
  if (amount === null || amount === undefined) return '0.00 ETB';
  return new Intl.NumberFormat('en-ET', {
    style: 'currency',
    currency: 'ETB',
    minimumFractionDigits: 2
  }).format(amount);
};

// ✅ 3. Capitalize First Letter
// Example: Converts "admin" to "Admin"
export const capitalize = (text: string): string => {
  if (!text) return '';
  return text.charAt(0).toUpperCase() + text.slice(1);
};

// ✅ 4. Validate Ethiopian Phone Number
// Example: Returns true for "0911223344", false for "12345"
export const isValidPhone = (phone: string): boolean => {
  const phoneRegex = /^(?:\+251|0)9\d{8}$/;
  return phoneRegex.test(phone);
};

// ✅ 5. Time Ago
// Example: Converts a date to "2 hours ago" or "Just now"
export const timeAgo = (dateString: string): string => {
  if (!dateString) return '';
  const date = new Date(dateString);
  const now = new Date();
  const seconds = Math.floor((now.getTime() - date.getTime()) / 1000);

  let interval = seconds / 31536000;
  if (interval > 1) return Math.floor(interval) + ' years ago';

  interval = seconds / 2592000;
  if (interval > 1) return Math.floor(interval) + ' months ago';

  interval = seconds / 86400;
  if (interval > 1) return Math.floor(interval) + ' days ago';

  interval = seconds / 3600;
  if (interval > 1) return Math.floor(interval) + ' hours ago';

  interval = seconds / 60;
  if (interval > 1) return Math.floor(interval) + ' minutes ago';

  return Math.floor(seconds) + ' seconds ago';
};

// ✅ 6. Get Initials
// Example: Converts "Werkyantfu Tewachew" to "WT"
export const getInitials = (name: string): string => {
  if (!name) return '';
  const names = name.split(' ');
  if (names.length === 1) return names[0].charAt(0).toUpperCase();
  return (names[0].charAt(0) + names[names.length - 1].charAt(0)).toUpperCase();
};